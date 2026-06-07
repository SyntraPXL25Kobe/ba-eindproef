import { Head } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Separator } from '@/components/ui/separator';

interface Sector {
    id: number;
    name: string;
}

interface Event {
    id: number;
    title: string;
    description: string | null;
    start_time: string;
    end_time: string;
    is_online: boolean;
}

interface Company {
    id: number;
    display_name: string;
    legal_name: string | null;
    description: string | null;
    email: string | null;
    phone: string | null;
    website_url: string | null;
    logo_url: string | null;
    sectors: Sector[];
    events: Event[];
}

interface Props {
    company: Company;
}

function formatDate(value: string): string {
    return new Date(value).toLocaleString('nl-BE', {
        dateStyle: 'medium',
        timeStyle: 'short',
    });
}

export default function CompanyShow({ company }: Props) {
    return (
        <>
            <Head title={company.display_name} />

            <div className="mx-auto max-w-4xl space-y-6 p-8">
                <div>
                    <h1 className="text-3xl font-bold">{company.display_name}</h1>
                    {company.legal_name && (
                        <p className="text-muted-foreground">{company.legal_name}</p>
                    )}
                    {company.sectors.length > 0 && (
                        <div className="mt-3 flex flex-wrap gap-1">
                            {company.sectors.map((sector) => (
                                <Badge key={sector.id} variant="secondary">
                                    {sector.name}
                                </Badge>
                            ))}
                        </div>
                    )}
                </div>

                {company.description && (
                    <p className="text-sm leading-relaxed">{company.description}</p>
                )}

                <Card>
                    <CardHeader>
                        <CardTitle>Contact</CardTitle>
                    </CardHeader>
                    <CardContent className="space-y-1 text-sm">
                        {company.email && <p>{company.email}</p>}
                        {company.phone && <p>{company.phone}</p>}
                        {company.website_url && (
                            <a>
                                href={company.website_url}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="text-primary underline"
                            
                                {company.website_url}
                            </a>
                        )}
                    </CardContent>
                </Card>

                <Separator />

                <div>
                    <h2 className="mb-4 text-xl font-semibold">Aankomende events</h2>
                    {company.events.length === 0 ? (
                        <p className="text-muted-foreground">Dit bedrijf heeft nog geen events.</p>
                    ) : (
                        <div className="space-y-3">
                            {company.events.map((event) => (
                                <Card key={event.id}>
                                    <CardHeader>
                                        <CardTitle className="text-base">{event.title}</CardTitle>
                                    </CardHeader>
                                    <CardContent className="space-y-2 text-sm">
                                        <p className="text-muted-foreground">
                                            {formatDate(event.start_time)} – {formatDate(event.end_time)}
                                        </p>
                                        <Badge variant={event.is_online ? 'default' : 'secondary'}>
                                            {event.is_online ? 'Online' : 'Op locatie'}
                                        </Badge>
                                        {event.description && <p>{event.description}</p>}
                                    </CardContent>
                                </Card>
                            ))}
                        </div>
                    )}
                </div>
            </div>
        </>
    );
}
