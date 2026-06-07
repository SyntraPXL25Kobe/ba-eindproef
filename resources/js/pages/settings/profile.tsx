import { Form, Head, usePage } from '@inertiajs/react';
import { Link } from '@inertiajs/react';
import ProfileController from '@/actions/App/Http/Controllers/Settings/ProfileController';
import DeleteUser from '@/components/delete-user';
import Heading from '@/components/heading';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { edit } from '@/routes/profile';
import { send } from '@/routes/verification';
import type { Auth } from '@/types';
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';

type PageProps = {
    auth: Auth;
};

export default function Profile({
    mustVerifyEmail,
    status,
}: {
    mustVerifyEmail: boolean;
    status?: string;
}) {
    const { auth } = usePage<PageProps>().props;

    const interesses = [
        'Full Stack Development',
        'Laravel',
        'WordPress',
        'Tailwind CSS',
        'PHP',
        'Supabase',
    ];

    return (
        <>
            <Head title="Profile settings" />

            <h1 className="sr-only">Profile settings</h1>

            <div className="space-y-6">
                <Tabs defaultValue="account" className="w-full">
                    {/* De navigatieknoppen bovenaan */}
                    <TabsList className="mb-6 grid w-full grid-cols-2">
                        <TabsTrigger value="account">Mijn Account</TabsTrigger>
                        <TabsTrigger value="interesses">Mijn Interesses</TabsTrigger>
                    </TabsList>

                    {/* Tabblad 1: De originele account instellingen */}
                    <TabsContent value="account" className="space-y-6">
                        <Heading
                            variant="small"
                            title="Profile"
                            description="Update your name and email address"
                        />
                        
                        <Form
                            {...ProfileController.update.form()}
                            options={{ preserveScroll: true }}
                            className="space-y-6"
                        >
                            <div className="grid gap-2">
                                <Label htmlFor="name">Name</Label>
                                <Input id="name" name="name" defaultValue={auth.user.name} />
                                <InputError message={undefined} />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="email">Email address</Label>
                                <Input id="email" type="email" name="email" defaultValue={auth.user.email} />
                                <InputError message={undefined} />
                            </div>

                            <div className="flex items-center gap-4">
                                <Button type="submit">Save</Button>
                            </div>
                        </Form>
                        
                        <DeleteUser />
                    </TabsContent>

                    {/* Tabblad 2: Jouw custom UI voor interesses */}
                    <TabsContent value="interesses">
                        <Card>
                            <CardHeader>
                                <CardTitle>Mijn Interesses</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div className="flex flex-wrap gap-2">
                                    {interesses.map((interesse, index) => (
                                        <Badge key={index}>{interesse}</Badge>
                                    ))}
                                </div>
                            </CardContent>
                        </Card>
                    </TabsContent>
                </Tabs>
            </div>
        </>
    );
}

Profile.layout = {
    breadcrumbs: [
        {
            title: 'Profile settings',
            href: edit(),
        },
    ],
};