import AppLayout from '@/layouts/app-layout';
import type { BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/react';
import type { FormEvent } from 'react';
import { type RoleOption, UserForm, type UserFormData } from '../components/user-form';

type CreateProps = {
    roles: RoleOption[];
};

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Kelola User', href: '/admin/users' },
    { title: 'Tambah User', href: '/admin/users/create' },
];

export default function Create({ roles }: CreateProps) {
    const { data, setData, post, processing, errors } = useForm<UserFormData>({
        name: '',
        email: '',
        role: 'user',
        password: '',
        password_confirmation: '',
    });

    const submit = (event: FormEvent) => {
        event.preventDefault();
        post('/admin/users');
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Tambah User" />
            <div className="flex flex-1 flex-col gap-4 p-4">
                <h1 className="text-xl font-semibold">Tambah User</h1>
                <UserForm
                    data={data}
                    errors={errors}
                    roles={roles}
                    processing={processing}
                    submitLabel="Simpan"
                    onChange={(field, value) => setData(field, value)}
                    onSubmit={submit}
                />
            </div>
        </AppLayout>
    );
}