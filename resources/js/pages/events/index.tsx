import { Head } from '@inertiajs/react';

export default function EventsIndex() {
    return (
        <>
            <Head title="Evenementen" />
            
            <div className="p-8">
                <h1 className="text-2xl font-bold mb-4">Evenementen Overzicht</h1>
                <p className="text-gray-600">
                    Hier kan je de lijst met evenementen bouwen
                </p>
            </div>
        </>
    );
}