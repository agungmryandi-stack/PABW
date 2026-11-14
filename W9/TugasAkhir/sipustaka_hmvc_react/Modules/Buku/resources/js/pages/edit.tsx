import AppLayout from '@/layouts/app-layout';
import type { BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/react';
import type { FormEvent } from 'react';
import { BukuForm, type BukuFormData } from '../components/buku-form';

type EditProps = {
    buku: {
        id: number;
        judul: string;
        penulis: string;
        penerbit: string;
        tahun_terbit: number;
        stok: number;
    };
};

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Buku', href: '/buku' },
    { title: 'Edit Buku', href: '#' },
];

export default function Edit({ buku }: EditProps) {
    const { data, setData, put, processing, errors } = useForm<BukuFormData>({
        judul: buku.judul,
        penulis: buku.penulis,
        penerbit: buku.penerbit,
        tahun_terbit: String(buku.tahun_terbit),
        stok: String(buku.stok),
    });

    const submit = (event: FormEvent) => {
        event.preventDefault();
        put(`/buku/${buku.id}`);
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Edit Buku" />
            <div className="flex flex-1 flex-col gap-4 p-4">
                <h1 className="text-xl font-semibold">Edit Buku</h1>
                <BukuForm
                    data={data}
                    errors={errors}
                    processing={processing}
                    submitLabel="Simpan Perubahan"
                    onChange={(field, value) => setData(field, value)}
                    onSubmit={submit}
                />
            </div>
        </AppLayout>
    );
}
