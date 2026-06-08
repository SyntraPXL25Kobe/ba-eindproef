import { Head, Link } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Separator } from '@/components/ui/separator';

interface Sector {
    id: number;
    name: string;
}

interface Address {
    id: number;
    street: string;
    house_number: string;
    postal_code: string;
    city: string;
}

interface EventDetail {
    id: number;
    title: string;
    description: string | null;
    start_time: string;
    end_time: string;
    is_online: boolean;
    online_url: string | null;
    company: { id: number; display_name: string } | null;
    event_type: { id: number; name: string } | null;
    sectors: Sector[];
    address: Address | null;
}

interface Props {
    event: EventDetail;
}

function formatDate(value: string): string {
    return new Date(value).toLocaleString('nl-BE', {
        dateStyle: 'full',
        timeStyle: 'short',
    });
}

export default function EventShow({ event }: Props) {
    return (
        <>
            <Head title={event.title} />

            <div className="mx-auto max-w-3xl space-y-6 p-8">
                <div>
                    <h1 className="text-3xl font-bold">{event.title}</h1>
                    {event.company && (
                        <Link href={`/companies/${event.company.id}`} className="text-primary underline">{event.company.display_name}</Link>
                    )}
                    <div className="mt-3 flex flex-wrap gap-1">
                        <Badge variant={event.is_online ? 'default' : 'secondary'}>
                            {event.is_online ? 'Online' : 'Op locatie'}
                        </Badge>
                        {event.event_type && <Badge variant="outline">{event.event_type.name}</Badge>}
                        {event.sectors.map((sector) => (
                            <Badge key={sector.id} variant="secondary">{sector.name}</Badge>
                        ))}
                    </div>
                </div>

                {event.description && (
                    <p className="text-sm leading-relaxed">{event.description}</p>
                )}

                <Separator />

                <Card>
                    <CardHeader>
                        <CardTitle>Wanneer</CardTitle>
                    </CardHeader>
                    <CardContent className="space-y-1 text-sm">
                        <p>Start: {formatDate(event.start_time)}</p>
                        <p>Einde: {formatDate(event.end_time)}</p>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader>
                        <CardTitle>Waar</CardTitle>
                    </CardHeader>
                    <CardContent className="space-y-1 text-sm">
                        {event.is_online ? (
                            event.online_url ? (
                                <a href={event.online_url} target="_blank" rel="noopener noreferrer" className="text-primary underline">{event.online_url}</a>
                            ) : (
                                <p className="text-muted-foreground">Online</p>
                            )
                        ) : event.address ? (
                            <p>{event.address.street} {event.address.house_number}, {event.address.postal_code} {event.address.city}</p>
                        ) : (
                            <p className="text-muted-foreground">Locatie nog niet bekend.</p>
                        )}
                    </CardContent>
                </Card>
            </div>
        </>
    );
}