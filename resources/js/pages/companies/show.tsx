import { Head } from '@inertiajs/react';

export default function CompanyShow({ companyId }: { companyId: string }) {
    return (
        <>
            <Head title={`Bedrijf ${companyId}`} />
            
            <div className="p-8">
                <h1 className="text-2xl font-bold mb-4">Bedrijf Detailpagina</h1>
                <p className="text-gray-600">
                    Dit is de detailweergave voor bedrijf met ID: {companyId}
                </p>
            </div>
        </>
    );
}