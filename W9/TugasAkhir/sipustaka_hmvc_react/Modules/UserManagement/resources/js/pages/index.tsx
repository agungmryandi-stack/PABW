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

type UserItem = {
    id: number;
    name: string;
    email: string;
    role: string;
    role_label: string;
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
    users: Paginated<UserItem>;
    filters: { search: string; role: string };
    roles: { value: string; label: string }[];
};

const breadcrumbs: BreadcrumbItem[] = [{ title: 'Kelola User', href: '/admin/users' }];

export default function Index({ users, filters, roles }: IndexProps) {
    const { user: currentUser } = useSharedProps();
    const [search, setSearch] = useState(filters.search);
    const [role, setRole] = useState(filters.role);
    const [deleting, setDeleting] = useState<UserItem | null>(null);
    const [processing, setProcessing] = useState(false);

    // Pencarian dan filter role dikirim lewat query string (?search=...&role=...)
    const applyFilter = (event?: FormEvent) => {
        event?.preventDefault();
        router.get('/admin/users', { search, role }, { preserveState: true, replace: true });
    };

    const resetFilter = () => {
        setSearch('');
        setRole('');
        router.get('/admin/users', {}, { preserveState: true, replace: true });
    };

    const handleDelete = () => {
        if (!deleting) {
            return;
        }

        router.delete(`/admin/users/${deleting.id}`, {
            preserveScroll: true,
            onStart: () => setProcessing(true),
            onFinish: () => {
                setProcessing(false);
                setDeleting(null);
            },
        });
    };

    const isFiltered = filters.search !== '' || filters.role !== '';

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Kelola User" />
            <div className="flex flex-1 flex-col gap-4 p-4">
                <div className="flex flex-wrap items-center justify-between gap-2">
                    <div>
                        <h1 className="flex items-center gap-2 text-xl font-semibold">
                            Kelola User <Badge variant="secondary">{users.total}</Badge>
                        </h1>
                        <p className="text-muted-foreground text-sm">Tambah, ubah, dan hapus akun pengguna SiPustaka.</p>
                    </div>

                    <Button asChild>
                        <Link href="/admin/users/create">
                            <Plus /> Tambah User
                        </Link>
                    </Button>
                </div>

                <FlashMessage />

                <form onSubmit={applyFilter} className="flex flex-wrap gap-2">
                    <div className="relative w-full max-w-xs">
                        <Search className="text-muted-foreground absolute top-1/2 left-3 size-4 -translate-y-1/2" />
                        <Input
                            value={search}
                            onChange={(event) => setSearch(event.target.value)}
                            placeholder="Cari nama atau email..."
                            className="pl-9"
                        />
                    </div>
                    <select
                        value={role}
                        onChange={(event) => setRole(event.target.value)}
                        className="border-input bg-background h-9 rounded-md border px-3 text-sm shadow-xs outline-none"
                    >
                        <option value="">Semua role</option>
                        {roles.map((item) => (
                            <option key={item.value} value={item.value}>
                                {item.label}
                            </option>
                        ))}
                    </select>
                    <Button type="submit">Cari</Button>
                    {isFiltered && (
                        <Button type="button" variant="secondary" onClick={resetFilter}>
                            Reset
                        </Button>
                    )}
                </form>

                <div className="overflow-x-auto rounded-xl border">
                    <table className="w-full text-sm">
                        <thead className="bg-muted/50 text-left">
                            <tr>
                                <th className="px-4 py-3 font-medium">No</th>
                                <th className="px-4 py-3 font-medium">Nama</th>
                                <th className="px-4 py-3 font-medium">Email</th>
                                <th className="px-4 py-3 font-medium">Role</th>
                                <th className="px-4 py-3 text-right font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {users.data.length === 0 && (
                                <tr>
                                    <td colSpan={5} className="text-muted-foreground px-4 py-8 text-center">
                                        {isFiltered ? 'User tidak ditemukan.' : 'Belum ada data user.'}
                                    </td>
                                </tr>
                            )}

                            {users.data.map((item, index) => (
                                <tr key={item.id} className="border-t">
                                    <td className="px-4 py-3">{(users.from ?? 1) + index}</td>
                                    <td className="px-4 py-3 font-medium">
                                        {item.name}
                                        {item.id === currentUser.id && (
                                            <Badge variant="outline" className="ml-2">
                                                Anda
                                            </Badge>
                                        )}
                                    </td>
                                    <td className="px-4 py-3">{item.email}</td>
                                    <td className="px-4 py-3">
                                        <Badge variant={item.role === 'admin' ? 'default' : 'secondary'}>{item.role_label}</Badge>
                                    </td>
                                    <td className="px-4 py-3">
                                        <div className="flex justify-end gap-2">
                                            <Button size="sm" variant="outline" asChild>
                                                <Link href={`/admin/users/${item.id}/edit`}>
                                                    <Pencil /> Edit
                                                </Link>
                                            </Button>
                                            {/* Admin tidak dapat menghapus akunnya sendiri */}
                                            {item.id !== currentUser.id && (
                                                <Button size="sm" variant="destructive" onClick={() => setDeleting(item)}>
                                                    <Trash2 /> Hapus
                                                </Button>
                                            )}
                                        </div>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>

                <div className="flex flex-wrap items-center justify-between gap-2 text-sm">
                    <p className="text-muted-foreground">
                        {users.total > 0 ? `Menampilkan ${users.from}-${users.to} dari ${users.total} user` : 'Tidak ada data untuk ditampilkan'}
                    </p>

                    <div className="flex items-center gap-2">
                        <span className="text-muted-foreground">
                            Halaman {users.current_page} dari {users.last_page}
                        </span>
                        {users.prev_page_url ? (
                            <Button size="sm" variant="outline" asChild>
                                <Link href={users.prev_page_url} preserveScroll>
                                    Sebelumnya
                                </Link>
                            </Button>
                        ) : (
                            <Button size="sm" variant="outline" disabled>
                                Sebelumnya
                            </Button>
                        )}
                        {users.next_page_url ? (
                            <Button size="sm" variant="outline" asChild>
                                <Link href={users.next_page_url} preserveScroll>
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
                description={`Yakin ingin menghapus user "${deleting?.name}"?`}
                processing={processing}
                onConfirm={handleDelete}
                onOpenChange={(open) => !open && setDeleting(null)}
            />
        </AppLayout>
    );
}