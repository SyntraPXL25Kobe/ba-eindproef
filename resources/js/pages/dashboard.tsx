import { Head, Link } from '@inertiajs/react';
import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import { dashboard } from '@/routes';
export default function Dashboard() {
    return (
        <>
            <Head title="Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="grid auto-rows-min gap-4 md:grid-cols-3">
                    <Link href="/events" className="flex aspect-video items-center justify-center rounded-xl border border-sidebar-border/70 text-lg font-semibold transition-colors hover:bg-accent dark:border-sidebar-border">Events</Link>
                    <Link href="/companies" className="flex aspect-video items-center justify-center rounded-xl border border-sidebar-border/70 text-lg font-semibold transition-colors hover:bg-accent dark:border-sidebar-border">Bedrijven</Link>
                    <a href="/admin" className="flex aspect-video items-center justify-center rounded-xl border border-sidebar-border/70 text-lg font-semibold transition-colors hover:bg-accent dark:border-sidebar-border">Admin</a>
                </div>
                <div className="relative min-h-[100vh] flex-1 overflow-hidden rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                    <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
                </div>
            </div>
        </>
    );
}
Dashboard.layout = {
    breadcrumbs: [
        {
            title: 'Dashboard',
            href: dashboard(),
        },
    ],
};