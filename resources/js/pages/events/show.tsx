import { Head } from '@inertiajs/react';

export default function EventShow({ eventId }: { eventId: string }) {
    return (
        <>
            <Head title={`Evenement ${eventId}`} />
            
            <div className="p-8">
                <h1 className="text-2xl font-bold mb-4">Event Detailpagina</h1>
                <p className="text-gray-600">
                    S3, dit is de detailweergave voor evenement met ID: {eventId}
                </p>
            </div>
        </>
    );
}