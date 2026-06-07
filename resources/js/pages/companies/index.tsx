import { Head, Link, router } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';

interface Sector {
    id: number;
    name: string;
}

interface Company {
    id: number;
    display_name: string;
    description: string | null;
    logo_url: string | null;
    sectors: Sector[];
}

interface Props {
    companies: Company[];
    sectors: Sector[];
    selectedSector: number | null;
}

export default function CompaniesIndex({ companies, sectors, selectedSector }: Props) {
    function filterBySector(sectorId: number | null) {
        router.get(
            '/companies',
            sectorId ? { sector: sectorId } : {},
            { preserveState: true, preserveScroll: true },
        );
    }

    return (
        <>
            <Head title="Bedrijven" />

            <div className="mx-auto max-w-5xl p-8">
                <h1 className="mb-6 text-2xl font-bold">Bedrijven</h1>

                <div className="mb-6 flex flex-wrap gap-2">
                    <Button
                        variant={selectedSector === null ? 'default' : 'outline'}
                        size="sm"
                        onClick={() => filterBySector(null)}
                    >
                        Alle
                    </Button>
                    {sectors.map((sector) => (
                        <Button
                            key={sector.id}
                            variant={selectedSector === sector.id ? 'default' : 'outline'}
                            size="sm"
                            onClick={() => filterBySector(sector.id)}
                        >
                            {sector.name}
                        </Button>
                    ))}
                </div>

                {companies.length === 0 ? (
                    <p className="text-muted-foreground">Geen bedrijven gevonden.</p>
                ) : (
                    <div className="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        {companies.map((company) => (
                            <Link key={company.id} href={`/companies/${company.id}`}>
                                <Card className="h-full transition-shadow hover:shadow-md">
                                    <CardHeader>
                                        <CardTitle>{company.display_name}</CardTitle>
                                    </CardHeader>
                                    <CardContent className="space-y-3">
                                        {company.description && (
                                            <p className="line-clamp-3 text-sm text-muted-foreground">
                                                {company.description}
                                            </p>
                                        )}
                                        {company.sectors.length > 0 && (
                                            <div className="flex flex-wrap gap-1">
                                                {company.sectors.map((sector) => (
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