import { Head } from "@inertiajs/react";

export default function ShowProfile({ userId }: { userId: string }) {
    return (
        <div className="p-8">
            <Head title={`Profiel van ${userId}`} />
            <h1 className="text-2xl font-bold">Profielpagina van gebruiker: {userId}</h1>
            <p>Hier komt straks de data van deze specifieke gebruiker uit de database.</p>
        </div>
    );
}