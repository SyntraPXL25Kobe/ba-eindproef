import { Head } from '@inertiajs/react';

export default function ProgramDetail({ programId }: { programId: string }) {
    return (
        <div className="p-8">
            <Head title={`Opleiding ${programId}`} />
            <h1 className="text-2xl font-bold">
                Details van opleiding: {programId}
            </h1>
        </div>
    );
}
