import { useSharedProps } from '@/hooks/use-shared-props';
import AppLayout from '@/layouts/app-layout';
import type { BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/react';
import type { FormEvent } from 'react';
import { type RoleOption, UserForm, type UserFormData } from '../components/user-form';

type EditProps = {
    user: { id: number; name: string; email: string; role: string };
    roles: RoleOption[];
};

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Kelola User', href: '/admin/users' },
    { title: 'Edit User', href: '#' },
];

export default function Edit({ user, roles }: EditProps) {
    const { user: currentUser } = useSharedProps();
    const { data, setData, put, processing, errors } = useForm<UserFormData>({
        name: user.name,
        email: user.email,
        role: user.role,
        password: '',
        password_confirmation: '',
    });

    const submit = (event: FormEvent) => {
        event.preventDefault();
        put(`/admin/users/${user.id}`);
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Edit User" />
            <div className="flex flex-1 flex-col gap-4 p-4">
                <h1 className="text-xl font-semibold">Edit User</h1>
                <UserForm
                    data={data}
                    errors={errors}
                    roles={roles}
                    processing={processing}
                    submitLabel="Simpan Perubahan"
                    isEditing
                    isOwnAccount={user.id === currentUser.id}
                    onChange={(field, value) => setData(field, value)}
                    onSubmit={submit}
                />
            </div>
        </AppLayout>
    );
}