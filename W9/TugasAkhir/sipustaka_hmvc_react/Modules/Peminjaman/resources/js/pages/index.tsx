import { AlertMessage } from '@/components/alert-message';
import { ConfirmDialog } from '@/components/confirm-dialog';
import InputError from '@/components/input-error';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import type { ValidationErrors } from '@/lib/http';
import { http, HttpError } from '@/lib/http';
import type { BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { FileImage, FileText, LoaderCircle, Pencil, Plus, Search, Trash2 } from 'lucide-react';
import type { ChangeEvent, FormEvent } from 'react';
import { useEffect, useMemo, useState } from 'react';

type Peminjaman = {
    id: number;
    nama_peminjam: string;
    judul_buku: string;
    tanggal_pinjam: string;
    tanggal_kembali: string;
    status: 'Dipinjam' | 'Dikembalikan';
    bukti: string | null;
    nama_bukti: string | null;
    bukti_url: string | null;
};

type FormFields = Pick<Peminjaman, 'nama_peminjam' | 'judul_buku' | 'tanggal_pinjam' | 'tanggal_kembali' | 'status'>;
type Message = { type: 'success' | 'error'; text: string } | null;

const emptyForm: FormFields = {
    nama_peminjam: '',
    judul_buku: '',
    tanggal_pinjam: '',
    tanggal_kembali: '',
    status: 'Dipinjam',
};

const textFields: { name: 'nama_peminjam' | 'judul_buku'; label: string }[] = [
    { name: 'nama_peminjam', label: 'Nama Peminjam' },
    { name: 'judul_buku', label: 'Judul Buku' },
];

const dateFields: { name: 'tanggal_pinjam' | 'tanggal_kembali'; label: string }[] = [
    { name: 'tanggal_pinjam', label: 'Tanggal Pinjam' },
    { name: 'tanggal_kembali', label: 'Tanggal Kembali' },
];

const urls = {
    data: '/peminjaman/data',
    store: '/peminjaman',
    edit: (id: number) => `/peminjaman/${id}/edit`,
    update: (id: number) => `/peminjaman/${id}`,
    destroy: (id: number) => `/peminjaman/${id}`,
};

const breadcrumbs: BreadcrumbItem[] = [{ title: 'Peminjaman', href: '/peminjaman' }];

// Mengubah 2026-11-13 menjadi 13-11-2026
function formatTanggal(value: string): string {
    const [year, month, day] = value.split('-');

    return `${day}-${month}-${year}`;
}

// Tautan bukti yang dibuka di tab baru, ikon dipilih berdasarkan ekstensi
function FileLink({ url, name }: { url: string | null; name: string | null }) {
    if (!url) {
        return <span className="text-muted-foreground">-</span>;
    }

    const Icon = name?.toLowerCase().endsWith('.pdf') ? FileText : FileImage;

    return (
        <a
            href={url}
            target="_blank"
            rel="noopener noreferrer"
            className="text-primary inline-flex items-center gap-1 underline-offset-4 hover:underline"
        >
            <Icon className="size-4" /> {name ?? 'Lihat bukti'}
        </a>
    );
}

export default function Index() {
    const [records, setRecords] = useState<Peminjaman[]>([]);
    const [loading, setLoading] = useState(true);
    const [keyword, setKeyword] = useState('');
    const [message, setMessage] = useState<Message>(null);
    const [dialogOpen, setDialogOpen] = useState(false);
    const [editing, setEditing] = useState<Peminjaman | null>(null);
    const [form, setForm] = useState<FormFields>(emptyForm);
    const [file, setFile] = useState<File | null>(null);
    const [fileInputKey, setFileInputKey] = useState(0);
    const [errors, setErrors] = useState<ValidationErrors>({});
    const [saving, setSaving] = useState(false);
    const [deleting, setDeleting] = useState<Peminjaman | null>(null);
    const [processingDelete, setProcessingDelete] = useState(false);

    const showError = (error: unknown, fallback: string) => {
        const text = error instanceof HttpError ? (error.data?.message ?? fallback) : fallback;
        setMessage({ type: 'error', text });
    };

    // Mengambil seluruh data peminjaman dari server (GET /peminjaman/data)
    const loadData = async () => {
        setLoading(true);

        try {
            setRecords(await http<Peminjaman[]>(urls.data));
        } catch (error) {
            showError(error, 'Gagal memuat data peminjaman.');
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        loadData();
    }, []);

    // Pencarian dilakukan di browser tanpa request baru ke server
    const filtered = useMemo(() => {
        const q = keyword.trim().toLowerCase();

        if (q === '') {
            return records;
        }

        return records.filter((item) => [item.nama_peminjam, item.judul_buku, item.status].some((value) => value.toLowerCase().includes(q)));
    }, [records, keyword]);

    const resetFileAndErrors = () => {
        setFile(null);
        setFileInputKey((key) => key + 1);
        setErrors({});
    };

    const openCreate = () => {
        setEditing(null);
        setForm(emptyForm);
        resetFileAndErrors();
        setDialogOpen(true);
    };

    // Mengambil satu data (GET /peminjaman/{id}/edit) lalu mengisi form di dialog
    const openEdit = async (id: number) => {
        try {
            const data = await http<Peminjaman>(urls.edit(id));

            setEditing(data);
            setForm({
                nama_peminjam: data.nama_peminjam,
                judul_buku: data.judul_buku,
                tanggal_pinjam: data.tanggal_pinjam,
                tanggal_kembali: data.tanggal_kembali,
                status: data.status,
            });
            resetFileAndErrors();
            setDialogOpen(true);
        } catch (error) {
            showError(error, 'Data tidak ditemukan.');
        }
    };

    const handleChange = (event: ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
        setForm({ ...form, [event.target.name]: event.target.value });
    };

    // Menyimpan data (tambah dan edit) menggunakan FormData karena membawa file
    const handleSubmit = async (event: FormEvent) => {
        event.preventDefault();
        setSaving(true);
        setErrors({});

        const formData = new FormData();
        Object.entries(form).forEach(([key, value]) => formData.append(key, value));

        if (file) {
            formData.append('bukti', file);
        }

        // PHP tidak membaca multipart pada method PUT, jadi dikirim POST + _method=PUT
        if (editing) {
            formData.append('_method', 'PUT');
        }

        try {
            const result = await http<{ success: string }>(editing ? urls.update(editing.id) : urls.store, {
                method: 'POST',
                body: formData,
            });

            setDialogOpen(false);
            setMessage({ type: 'success', text: result.success });
            await loadData();
        } catch (error) {
            if (error instanceof HttpError && error.status === 422) {
                setErrors(error.data?.errors ?? {});
            } else {
                showError(error, 'Terjadi kesalahan, silakan coba lagi.');
            }
        } finally {
            setSaving(false);
        }
    };

    // Menghapus data (DELETE /peminjaman/{id}) setelah dikonfirmasi
    const handleDelete = async () => {
        if (!deleting) {
            return;
        }

        setProcessingDelete(true);

        try {
            const result = await http<{ success: string }>(urls.destroy(deleting.id), { method: 'DELETE' });

            setMessage({ type: 'success', text: result.success });
            await loadData();
        } catch (error) {
            showError(error, 'Data gagal dihapus.');
        } finally {
            setProcessingDelete(false);
            setDeleting(null);
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Peminjaman" />
            <div className="flex flex-1 flex-col gap-4 p-4">
                <div className="flex flex-wrap items-center justify-between gap-2">
                    <div>
                        <h1 className="flex items-center gap-2 text-xl font-semibold">
                            Data Peminjaman <Badge variant="secondary">{records.length}</Badge>
                        </h1>
                        <p className="text-muted-foreground text-sm">
                            Seluruh operasi pada halaman ini berjalan dengan AJAX tanpa memuat ulang halaman.
                        </p>
                    </div>

                    <Button onClick={openCreate}>
                        <Plus /> Tambah Peminjaman
                    </Button>
                </div>

                <AlertMessage type={message?.type ?? 'success'} message={message?.text} onClose={() => setMessage(null)} />

                <div className="relative max-w-sm">
                    <Search className="text-muted-foreground absolute top-1/2 left-3 size-4 -translate-y-1/2" />
                    <Input
                        value={keyword}
                        onChange={(event) => setKeyword(event.target.value)}
                        placeholder="Cari nama, judul buku, status..."
                        className="pl-9"
                    />
                </div>

                <div className="overflow-x-auto rounded-xl border">
                    <table className="w-full text-sm">
                        <thead className="bg-muted/50 text-left">
                            <tr>
                                <th className="px-4 py-3 font-medium">No</th>
                                <th className="px-4 py-3 font-medium">Nama Peminjam</th>
                                <th className="px-4 py-3 font-medium">Judul Buku</th>
                                <th className="px-4 py-3 font-medium">Tgl Pinjam</th>
                                <th className="px-4 py-3 font-medium">Tgl Kembali</th>
                                <th className="px-4 py-3 font-medium">Status</th>
                                <th className="px-4 py-3 font-medium">Bukti</th>
                                <th className="px-4 py-3 text-right font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {loading && (
                                <tr>
                                    <td colSpan={8} className="text-muted-foreground px-4 py-8 text-center">
                                        <LoaderCircle className="mx-auto size-5 animate-spin" />
                                    </td>
                                </tr>
                            )}

                            {!loading && filtered.length === 0 && (
                                <tr>
                                    <td colSpan={8} className="text-muted-foreground px-4 py-8 text-center">
                                        {records.length === 0 ? 'Belum ada data peminjaman.' : 'Data tidak ditemukan.'}
                                    </td>
                                </tr>
                            )}

                            {!loading &&
                                filtered.map((item, index) => (
                                    <tr key={item.id} className="border-t">
                                        <td className="px-4 py-3">{index + 1}</td>
                                        <td className="px-4 py-3 font-medium">{item.nama_peminjam}</td>
                                        <td className="px-4 py-3">{item.judul_buku}</td>
                                        <td className="px-4 py-3">{formatTanggal(item.tanggal_pinjam)}</td>
                                        <td className="px-4 py-3">{formatTanggal(item.tanggal_kembali)}</td>
                                        <td className="px-4 py-3">
                                            <Badge variant={item.status === 'Dipinjam' ? 'default' : 'secondary'}>{item.status}</Badge>
                                        </td>
                                        <td className="px-4 py-3">
                                            <FileLink url={item.bukti_url} name={item.nama_bukti} />
                                        </td>
                                        <td className="px-4 py-3">
                                            <div className="flex justify-end gap-2">
                                                <Button size="sm" variant="outline" onClick={() => openEdit(item.id)}>
                                                    <Pencil /> Edit
                                                </Button>
                                                <Button size="sm" variant="destructive" onClick={() => setDeleting(item)}>
                                                    <Trash2 /> Hapus
                                                </Button>
                                            </div>
                                        </td>
                                    </tr>
                                ))}
                        </tbody>
                    </table>
                </div>
            </div>

            <Dialog open={dialogOpen} onOpenChange={(open) => !saving && setDialogOpen(open)}>
                <DialogContent className="sm:max-w-lg">
                    <form onSubmit={handleSubmit} noValidate className="space-y-4">
                        <DialogHeader>
                            <DialogTitle>{editing ? 'Edit Peminjaman' : 'Tambah Peminjaman'}</DialogTitle>
                            <DialogDescription>Lengkapi data peminjaman beserta bukti peminjamannya.</DialogDescription>
                        </DialogHeader>

                        {textFields.map((field) => (
                            <div key={field.name} className="grid gap-2">
                                <Label htmlFor={field.name}>{field.label}</Label>
                                <Input
                                    id={field.name}
                                    name={field.name}
                                    value={form[field.name]}
                                    onChange={handleChange}
                                    aria-invalid={!!errors[field.name]}
                                />
                                <InputError message={errors[field.name]?.[0]} />
                            </div>
                        ))}

                        <div className="grid gap-4 sm:grid-cols-2">
                            {dateFields.map((field) => (
                                <div key={field.name} className="grid gap-2">
                                    <Label htmlFor={field.name}>{field.label}</Label>
                                    <Input
                                        id={field.name}
                                        name={field.name}
                                        type="date"
                                        value={form[field.name]}
                                        onChange={handleChange}
                                        aria-invalid={!!errors[field.name]}
                                    />
                                    <InputError message={errors[field.name]?.[0]} />
                                </div>
                            ))}
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="status">Status</Label>
                            <select
                                id="status"
                                name="status"
                                value={form.status}
                                onChange={handleChange}
                                className="border-input bg-background focus-visible:ring-ring/50 h-9 rounded-md border px-3 text-sm shadow-xs outline-none focus-visible:ring-[3px]"
                            >
                                <option value="Dipinjam">Dipinjam</option>
                                <option value="Dikembalikan">Dikembalikan</option>
                            </select>
                            <InputError message={errors.status?.[0]} />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="bukti">Bukti Peminjaman</Label>
                            <Input
                                key={fileInputKey}
                                id="bukti"
                                type="file"
                                accept=".jpg,.jpeg,.png,.pdf"
                                onChange={(event) => setFile(event.target.files?.[0] ?? null)}
                                aria-invalid={!!errors.bukti}
                            />
                            <p className="text-muted-foreground text-xs">
                                Format jpg, jpeg, png, atau pdf, maksimal 2 MB.
                                {editing && ' Kosongkan jika tidak ingin mengganti file.'}
                            </p>

                            {editing?.bukti_url && (
                                <p className="text-xs">
                                    Bukti saat ini: <FileLink url={editing.bukti_url} name={editing.nama_bukti} />
                                </p>
                            )}

                            <InputError message={errors.bukti?.[0]} />
                        </div>

                        <DialogFooter className="gap-2">
                            <Button type="button" variant="secondary" onClick={() => setDialogOpen(false)} disabled={saving}>
                                Batal
                            </Button>
                            <Button type="submit" disabled={saving}>
                                {saving && <LoaderCircle className="animate-spin" />}
                                {saving ? 'Menyimpan...' : 'Simpan'}
                            </Button>
                        </DialogFooter>
                    </form>
                </DialogContent>
            </Dialog>

            <ConfirmDialog
                open={deleting !== null}
                description={`Yakin ingin menghapus peminjaman oleh ${deleting?.nama_peminjam} beserta file buktinya?`}
                processing={processingDelete}
                onConfirm={handleDelete}
                onOpenChange={(open) => !open && setDeleting(null)}
            />
        </AppLayout>
    );
}