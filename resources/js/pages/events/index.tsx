import { Head, Link, router } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';

interface Sector {
    id: number;
    name: string;
}

interface EventType {
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
    eventTypes: EventType[];
    selectedSector: number | null;
    selectedType: number | null;
    selectedLocation: string | null;
}

function formatDate(value: string): string {
    return new Date(value).toLocaleString('nl-BE', {
        dateStyle: 'medium',
        timeStyle: 'short',
    });
}

export default function EventsIndex({ events, sectors, eventTypes, selectedSector, selectedType, selectedLocation }: Props) {
    function applyFilters(next: { sector?: number | null; type?: number | null; location?: string | null }) {
        const sector = next.sector !== undefined ? next.sector : selectedSector;
        const type = next.type !== undefined ? next.type : selectedType;
        const location = next.location !== undefined ? next.location : selectedLocation;
        const params: Record<string, string | number> = {};
        if (sector) params.sector = sector;
        if (type) params.type = type;
        if (location) params.location = location;
        router.get('/events', params, { preserveState: true, preserveScroll: true });
    }

    return (
        <>
            <Head title="Events" />

            <div className="mx-auto max-w-5xl p-8">
                <h1 className="mb-6 text-2xl font-bold">Events</h1>

                <div className="mb-3 flex flex-wrap gap-2">
                    <span className="self-center text-sm font-medium text-muted-foreground">Sector:</span>
                    <Button variant={selectedSector === null ? 'default' : 'outline'} size="sm" onClick={() => applyFilters({ sector: null })}>
                        Alle
                    </Button>
                    {sectors.map((sector) => (
                        <Button key={sector.id} variant={selectedSector === sector.id ? 'default' : 'outline'} size="sm" onClick={() => applyFilters({ sector: sector.id })}>
                            {sector.name}
                        </Button>
                    ))}
                </div>

                <div className="mb-3 flex flex-wrap gap-2">
                    <span className="self-center text-sm font-medium text-muted-foreground">Type:</span>
                    <Button variant={selectedType === null ? 'default' : 'outline'} size="sm" onClick={() => applyFilters({ type: null })}>
                        Alle
                    </Button>
                    {eventTypes.map((type) => (
                        <Button key={type.id} variant={selectedType === type.id ? 'default' : 'outline'} size="sm" onClick={() => applyFilters({ type: type.id })}>
                            {type.name}
                        </Button>
                    ))}
                </div>

                <div className="mb-6 flex flex-wrap gap-2">
                    <span className="self-center text-sm font-medium text-muted-foreground">Locatie:</span>
                    <Button variant={selectedLocation === null ? 'default' : 'outline'} size="sm" onClick={() => applyFilters({ location: null })}>
                        Alle
                    </Button>
                    <Button variant={selectedLocation === 'online' ? 'default' : 'outline'} size="sm" onClick={() => applyFilters({ location: 'online' })}>
                        Online
                    </Button>
                    <Button variant={selectedLocation === 'offline' ? 'default' : 'outline'} size="sm" onClick={() => applyFilters({ location: 'offline' })}>
                        Op locatie
                    </Button>
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