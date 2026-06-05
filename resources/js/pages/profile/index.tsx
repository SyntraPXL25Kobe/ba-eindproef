import { Head } from '@inertiajs/react';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

export default function ProfileIndex() {
    // 1. Nieuwe array met data (alsof het uit de database komt)
    const interesses = [
        'Full Stack Development',
        'Laravel',
        'WordPress',
        'Tailwind CSS',
        'PHP',
        'Supabase',
    ];

    return (
        <div className="mx-auto max-w-4xl space-y-6 p-8">
            <Head title="Mijn Profiel" />

            <div className="flex items-center justify-between">
                <h1 className="text-3xl font-bold">Mijn Profiel</h1>
                <Button variant="outline">Bewerk Profiel</Button>
            </div>

            <div className="grid gap-6 md:grid-cols-2">
                {/* Kaart 1: Persoonlijke Info */}
                <Card>
                    <CardHeader>
                        <CardTitle>Persoonlijke Gegevens</CardTitle>
                    </CardHeader>
                    <CardContent className="space-y-2">
                        <p>
                            <strong>Naam:</strong> Maxime
                        </p>
                        <p>
                            <strong>Opleiding:</strong> Bachelor Toegepaste
                            Informatica
                        </p>
                        <p>
                            <strong>E-mail:</strong> maxime@example.com
                        </p>
                    </CardContent>
                </Card>

                {/* Kaart 2: Interesses */}
                <Card>
                    <CardHeader>
                        <CardTitle>Mijn Interesses</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div className="flex flex-wrap gap-2">
                            {/* 2. Hier gebruiken we .map() om door de array te lopen */}
                            {interesses.map((interesse, index) => (
                                <Badge key={index}>{interesse}</Badge>
                            ))}
                        </div>
                    </CardContent>
                </Card>
            </div>
        </div>
    );
}
