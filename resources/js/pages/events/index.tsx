import { Head, Link, router } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';

interface Sector {
    id: number;
    name: string;
}

interface EventItem {
    id: number;
    title: string;
    description: string | null;
    start_time: string;
    end_time: string;
    is_online: boolean;
    company: { id: number; display_name: string } | null;
    event_type: { id: number; name: string } | null;
    sectors: Sector[];
}

interface Props {
    events: EventItem[];
    sectors: Sector[];
    selectedSector: number | null;
}

function formatDate(value: string): string {
    return new Date(value).toLocaleString('nl-BE', {
        dateStyle: 'medium',
        timeStyle: 'short',
    });
}

export default function EventsIndex({ events, sectors, selectedSector }: Props) {
    function filterBySector(sectorId: number | null) {
        router.get('/events', sectorId ? { sector: sectorId } : {}, { preserveState: true, preserveScroll: true });
    }

    return (
        <>
            <Head title="Events" />

            <div className="mx-auto max-w-5xl p-8">
                <h1 className="mb-6 text-2xl font-bold">Events</h1>

                <div className="mb-6 flex flex-wrap gap-2">
                    <Button variant={selectedSector === null ? 'default' : 'outline'} size="sm" onClick={() => filterBySector(null)}>
                        Alle
                    </Button>
                    {sectors.map((sector) => (
                        <Button key={sector.id} variant={selectedSector === sector.id ? 'default' : 'outline'} size="sm" onClick={() => filterBySector(sector.id)}>
                            {sector.name}
                        </Button>
                    ))}
                </div>

                {events.length === 0 ? (
                    <p className="text-muted-foreground">Er zijn geen aankomende events.</p>
                ) : (
                    <div className="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        {events.map((event) => (
                            <Link key={event.id} href={`/events/${event.id}`}>
                                <Card className="h-full transition-shadow hover:shadow-md">
                                    <CardHeader>
                                        <CardTitle className="text-base">{event.title}</CardTitle>
                                        {event.company && (
                                            <p className="text-sm text-muted-foreground">{event.company.display_name}</p>
                                        )}
                                    </CardHeader>
                                    <CardContent className="space-y-3 text-sm">
                                        <p className="text-muted-foreground">{formatDate(event.start_time)}</p>
                                        <div className="flex flex-wrap gap-1">
                                            <Badge variant={event.is_online ? 'default' : 'secondary'}>
                                                {event.is_online ? 'Online' : 'Op locatie'}
                                            </Badge>
                                            {event.event_type && (
                                                <Badge variant="outline">{event.event_type.name}</Badge>
                                            )}
                                        </div>
                                        {event.sectors.length > 0 && (
                                            <div className="flex flex-wrap gap-1">
                                                {event.sectors.map((sector) => (
                                                    <Badge key={sector.id} variant="secondary">
                                                        {sector.name}
                                                    </Badge>
                                                ))}
                                            </div>
                                        )}
                                    </CardContent>
                                </Card>
                            </Link>
                        ))}
                    </div>
                )}
            </div>
        </>
    );
}