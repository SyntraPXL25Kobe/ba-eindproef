import { Head, Link } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';

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
}

export default function CompaniesIndex({ companies }: Props) {
    return (
        <>
            <Head title="Bedrijven" />

            <div className="mx-auto max-w-5xl p-8">
                <h1 className="mb-6 text-2xl font-bold">Bedrijven</h1>

                {companies.length === 0 ? (
                    <p className="text-muted-foreground">Er zijn nog geen bedrijven.</p>
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