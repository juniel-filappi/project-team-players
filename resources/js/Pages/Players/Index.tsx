import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, router } from '@inertiajs/react';
import { PageProps } from '@/types';
import Table from "@/Components/Table";
import PrimaryButton from "@/Components/PrimaryButton";
import { IPlayer } from "@/interfaces/IPlayer";
import { format } from "date-fns";
import { PLAYER_LEVELS_MAP } from "@/variables/PlayerVariables";

export default function Index({ auth, players }: PageProps<{ players: IPlayer[] }>) {
    const headers = [
        {
            field: 'name',
            headerName: 'Name',
        },
        {
            field: 'level',
            headerName: 'Level',
            valueGetter: (row: any) => PLAYER_LEVELS_MAP[row.level as keyof typeof PLAYER_LEVELS_MAP],
        },
        {
            field: 'is_goalkeeper',
            headerName: 'Goalkeeper',
            valueGetter: (row: any) => row.is_goalkeeper ? 'Yes' : 'No',
        },
        {
            field: 'confirmed',
            headerName: 'Confirmed',
            valueGetter: (row: any) => row.confirmed ? 'Yes' : 'No',
        },
        {
            field: 'created_at',
            headerName: 'Created At',
            valueGetter: (row: any) => format(new Date(row.created_at), 'yyyy-MM-dd HH:mm:ss'),
        }
    ];

    const onDelete = (id: number) => {
        router.delete(route('players.delete', id), {
            preserveScroll: true,
            onBefore: () => {
                if (!confirm('Are you sure you want to delete this player?')) {
                    return false;
                }
            }
        })
    }

    const onEdit = (id: number) => {
        router.get(route('players.edit', id));
    }


    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Players</h2>}
        >
            <Head title="Players" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div className="flex justify-end mb-4">
                        <Link
                            href={route('players.create')}
                        >
                            <PrimaryButton>Create Player</PrimaryButton>
                        </Link>
                    </div>
                    <div className="relative overflow-x-auto">
                        <Table
                            headers={headers}
                            rows={players}
                            onEdit={onEdit}
                            onDelete={onDelete}
                        />
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
