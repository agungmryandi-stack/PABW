import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Link } from '@inertiajs/react';
import { LoaderCircle } from 'lucide-react';
import type { FormEvent } from 'react';

export type BukuFormData = {
    judul: string;
    penulis: string;
    penerbit: string;
    tahun_terbit: string;
    stok: string;
};

type BukuFormProps = {
    data: BukuFormData;
    errors: Partial<Record<keyof BukuFormData, string>>;
    processing: boolean;
    submitLabel: string;
    onChange: (field: keyof BukuFormData, value: string) => void;
    onSubmit: (event: FormEvent) => void;
};

const fields: { name: keyof BukuFormData; label: string; type: string }[] = [
    { name: 'judul', label: 'Judul', type: 'text' },
    { name: 'penulis', label: 'Penulis', type: 'text' },
    { name: 'penerbit', label: 'Penerbit', type: 'text' },
    { name: 'tahun_terbit', label: 'Tahun Terbit', type: 'number' },
    { name: 'stok', label: 'Stok', type: 'number' },
];

export function BukuForm({ data, errors, processing, submitLabel, onChange, onSubmit }: BukuFormProps) {
    return (
        <form onSubmit={onSubmit} noValidate className="max-w-xl space-y-4">
            {fields.map((field) => (
                <div key={field.name} className="grid gap-2">
                    <Label htmlFor={field.name}>{field.label}</Label>
                    <Input
                        id={field.name}
                        type={field.type}
                        value={data[field.name]}
                        onChange={(event) => onChange(field.name, event.target.value)}
                        aria-invalid={!!errors[field.name]}
                    />
                    <InputError message={errors[field.name]} />
                </div>
            ))}

            <div className="flex gap-2">
                <Button type="submit" disabled={processing}>
                    {processing && <LoaderCircle className="animate-spin" />}
                    {submitLabel}
                </Button>
                <Button type="button" variant="secondary" asChild>
                    <Link href="/buku">Batal</Link>
                </Button>
            </div>
        </form>
    );
}