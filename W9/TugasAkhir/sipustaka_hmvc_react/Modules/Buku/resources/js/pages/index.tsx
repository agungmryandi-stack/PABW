import { FlashMessage } from '@/components/alert-message';
import { ConfirmDialog } from '@/components/confirm-dialog';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { useSharedProps } from '@/hooks/use-shared-props';
import AppLayout from '@/layouts/app-layout';
import type { BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/react';
import { Pencil, Plus, Search, Trash2 } from 'lucide-react';
import type { FormEvent } from 'react';
import { useState } from 'react';

type Buku = {
    id: number;
    judul: string;
    penulis: string;
    penerbit: string;
    tahun_terbit: number;
    stok: number;
};

type Paginated<T> = {
    data: T[];
    from: number | null;
    to: number | null;
    total: number;
    current_page: number;
    last_page: number;
    prev_page_url: string | null;
    next_page_url: string | null;
};

type IndexProps = {
    bukus: Paginated<Buku>;
    filters: { search: string };
};

const breadcrumbs: BreadcrumbItem[] = [{ title: 'Buku', href: '/buku' }];

export default function Index({ bukus, filters }: IndexProps) {
    const { isAdmin } = useSharedProps();
    const [search, setSearch] = useState(filters.search);
    const [deleting, setDeleting] = useState<Buku | null>(null);
    const [processing, setProcessing] = useState(false);

    // Pencarian dikirim ke server lewat query string (?search=...)
    const submitSearch = (event: FormEvent) => {
        event.preventDefault();
        router.get('/buku', { search }, { preserveState: true, replace: true });
    };

    const resetSearch = () => {
        setSearch('');
        router.get('/buku', {}, { preserveState: true, replace: true });
    };

    const handleDelete = () => {
        if (!deleting) {
            return;
        }

        router.delete(`/buku/${deleting.id}`, {
            preserveScroll: true,
            onStart: () => setProcessing(true),
            onFinish: () => {
                setProcessing(false);
                setDeleting(null);
            },
        });
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Buku" />
            <div className="flex flex-1 flex-col gap-4 p-4">
                <div className="flex flex-wrap items-center justify-between gap-2">
                    <div>
                        <h1 className="flex items-center gap-2 text-xl font-semibold">
                            Data Buku <Badge variant="secondary">{bukus.total}</Badge>
                        </h1>
                        <p className="text-muted-foreground text-sm">
                            {isAdmin ? 'Kelola koleksi buku perpustakaan.' : 'Daftar koleksi buku perpustakaan.'}
                        </p>
                    </div>

                    {isAdmin && (
                        <Button asChild>
                            <Link href="/buku/create">
                                <Plus /> Tambah Buku
                            </Link>
                        </Button>
                    )}
                </div>

                <FlashMessage />

                <form onSubmit={submitSearch} className="flex max-w-md gap-2">
                    <div className="relative flex-1">
                        <Search className="text-muted-foreground absolute top-1/2 left-3 size-4 -translate-y-1/2" />
                        <Input
                            value={search}
                            onChange={(event) => setSearch(event.target.value)}
                            placeholder="Cari judul, penulis, penerbit..."
                            className="pl-9"
                        />
                    </div>
                    <Button type="submit">Cari</Button>
                    {filters.search !== '' && (
                        <Button type="button" variant="secondary" onClick={resetSearch}>
                            Reset
                        </Button>
                    )}
                </form>

                <div className="overflow-x-auto rounded-xl border">
                    <table className="w-full text-sm">
                        <thead className="bg-muted/50 text-left">
                            <tr>
                                <th className="px-4 py-3 font-medium">No</th>
                                <th className="px-4 py-3 font-medium">Judul</th>
                                <th className="px-4 py-3 font-medium">Penulis</th>
                                <th className="px-4 py-3 font-medium">Penerbit</th>
                                <th className="px-4 py-3 font-medium">Tahun</th>
                                <th className="px-4 py-3 font-medium">Stok</th>
                                {isAdmin && <th className="px-4 py-3 text-right font-medium">Aksi</th>}
                            </tr>
                        </thead>
                        <tbody>
                            {bukus.data.length === 0 && (
                                <tr>
                                    <td colSpan={isAdmin ? 7 : 6} className="text-muted-foreground px-4 py-8 text-center">
                                        {filters.search !== '' ? 'Buku tidak ditemukan.' : 'Belum ada data buku.'}
                                    </td>
                                </tr>
                            )}

                            {bukus.data.map((buku, index) => (
                                <tr key={buku.id} className="border-t">
                                    <td className="px-4 py-3">{(bukus.from ?? 1) + index}</td>
                                    <td className="px-4 py-3 font-medium">{buku.judul}</td>
                                    <td className="px-4 py-3">{buku.penulis}</td>
                                    <td className="px-4 py-3">{buku.penerbit}</td>
                                    <td className="px-4 py-3">{buku.tahun_terbit}</td>
                                    <td className="px-4 py-3">{buku.stok}</td>
                                    {isAdmin && (
                                        <td className="px-4 py-3">
                                            <div className="flex justify-end gap-2">
                                                <Button size="sm" variant="outline" asChild>
                                                    <Link href={`/buku/${buku.id}/edit`}>
                                                        <Pencil /> Edit
                                                    </Link>
                                                </Button>
                                                <Button size="sm" variant="destructive" onClick={() => setDeleting(buku)}>
                                                    <Trash2 /> Hapus
                                                </Button>
                                            </div>
                                        </td>
                                    )}
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>

                <div className="flex flex-wrap items-center justify-between gap-2 text-sm">
                    <p className="text-muted-foreground">
                        {bukus.total > 0 ? `Menampilkan ${bukus.from}-${bukus.to} dari ${bukus.total} buku` : 'Tidak ada data untuk ditampilkan'}
                    </p>

                    <div className="flex items-center gap-2">
                        <span className="text-muted-foreground">
                            Halaman {bukus.current_page} dari {bukus.last_page}
                        </span>
                        {bukus.prev_page_url ? (
                            <Button size="sm" variant="outline" asChild>
                                <Link href={bukus.prev_page_url} preserveScroll>
                                    Sebelumnya
                                </Link>
                            </Button>
                        ) : (
                            <Button size="sm" variant="outline" disabled>
                                Sebelumnya
                            </Button>
                        )}
                        {bukus.next_page_url ? (
                            <Button size="sm" variant="outline" asChild>
                                <Link href={bukus.next_page_url} preserveScroll>
                                    Berikutnya
                                </Link>
                            </Button>
                        ) : (
                            <Button size="sm" variant="outline" disabled>
                                Berikutnya
                            </Button>
                        )}
                    </div>
                </div>
            </div>

            <ConfirmDialog
                open={deleting !== null}
                description={`Yakin ingin menghapus buku "${deleting?.judul}"?`}
                processing={processing}
                onConfirm={handleDelete}
                onOpenChange={(open) => !open && setDeleting(null)}
            />
        </AppLayout>
    );
}