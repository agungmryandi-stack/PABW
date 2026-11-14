import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Link } from '@inertiajs/react';
import { LoaderCircle } from 'lucide-react';
import type { FormEvent } from 'react';

export type UserFormData = {
    name: string;
    email: string;
    role: string;
    password: string;
    password_confirmation: string;
};

export type RoleOption = { value: string; label: string };

type UserFormProps = {
    data: UserFormData;
    errors: Partial<Record<keyof UserFormData, string>>;
    roles: RoleOption[];
    processing: boolean;
    submitLabel: string;
    isEditing?: boolean;
    isOwnAccount?: boolean;
    onChange: (field: keyof UserFormData, value: string) => void;
    onSubmit: (event: FormEvent) => void;
};

export function UserForm({
    data,
    errors,
    roles,
    processing,
    submitLabel,
    isEditing = false,
    isOwnAccount = false,
    onChange,
    onSubmit,
}: UserFormProps) {
    return (
        <form onSubmit={onSubmit} noValidate className="max-w-xl space-y-4">
            <div className="grid gap-2">
                <Label htmlFor="name">Nama</Label>
                <Input id="name" value={data.name} onChange={(event) => onChange('name', event.target.value)} aria-invalid={!!errors.name} />
                <InputError message={errors.name} />
            </div>

            <div className="grid gap-2">
                <Label htmlFor="email">Email</Label>
                <Input
                    id="email"
                    type="email"
                    value={data.email}
                    onChange={(event) => onChange('email', event.target.value)}
                    aria-invalid={!!errors.email}
                />
                <InputError message={errors.email} />
            </div>

            <div className="grid gap-2">
                <Label htmlFor="role">Role</Label>
                <select
                    id="role"
                    value={data.role}
                    onChange={(event) => onChange('role', event.target.value)}
                    disabled={isOwnAccount}
                    className="border-input bg-background focus-visible:ring-ring/50 h-9 rounded-md border px-3 text-sm shadow-xs outline-none focus-visible:ring-[3px] disabled:opacity-60"
                >
                    {roles.map((role) => (
                        <option key={role.value} value={role.value}>
                            {role.label}
                        </option>
                    ))}
                </select>
                {isOwnAccount && <p className="text-muted-foreground text-xs">Role akun Anda sendiri tidak dapat diturunkan.</p>}
                <InputError message={errors.role} />
            </div>

            <div className="grid gap-2">
                <Label htmlFor="password">Password</Label>
                <Input
                    id="password"
                    type="password"
                    value={data.password}
                    onChange={(event) => onChange('password', event.target.value)}
                    aria-invalid={!!errors.password}
                />
                {isEditing && <p className="text-muted-foreground text-xs">Kosongkan jika tidak ingin mengganti password.</p>}
                <InputError message={errors.password} />
            </div>

            <div className="grid gap-2">
                <Label htmlFor="password_confirmation">Konfirmasi Password</Label>
                <Input
                    id="password_confirmation"
                    type="password"
                    value={data.password_confirmation}
                    onChange={(event) => onChange('password_confirmation', event.target.value)}
                />
            </div>

            <div className="flex gap-2">
                <Button type="submit" disabled={processing}>
                    {processing && <LoaderCircle className="animate-spin" />}
                    {submitLabel}
                </Button>
                <Button type="button" variant="secondary" asChild>
                    <Link href="/admin/users">Batal</Link>
                </Button>
            </div>
        </form>
    );
}