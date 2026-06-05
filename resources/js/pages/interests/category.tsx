import { Head } from "@inertiajs/react";

export default function Category({ categoryId }: { categoryId: string }) {
    return (
        <div className="p-8">
            <Head title={`Categorie ${categoryId}`} />
            <h1 className="text-2xl font-bold">Opleidingen voor categorie: {categoryId}</h1>
        </div>
    );
}