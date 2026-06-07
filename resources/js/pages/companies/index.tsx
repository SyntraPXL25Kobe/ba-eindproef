import { Head } from '@inertiajs/react';

export default function CompaniesIndex() {
    return (
        <>
            <Head title="Bedrijven" />
            
            <div className="p-8">
                <h1 className="text-2xl font-bold mb-4">Bedrijven Overzicht</h1>
                <p className="text-gray-600">
                    Hier kan je de lijst met bedrijven gaan bouwen
                </p>
            </div>
        </>
    );
}