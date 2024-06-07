import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { PageProps } from '@/types';
import { format } from "date-fns";
import { PLAYER_LEVELS_MAP } from "@/variables/PlayerVariables";
import { ITeam } from "@/interfaces/Team";

export default function Team({ auth, teams }: PageProps<{ teams: ITeam[] }>) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Teams</h2>}
        >
            <Head title="Teams" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div className="relative overflow-x-auto">
                        {teams.map((team, index) => (
                            <div key={index} className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                <h2 className="text-xl font-semibold">Team {index + 1}</h2>
                                <table className="w-full mt-4 text-center">
                                    <thead className="text-xs text-gray-700 uppercase bg-gray-300">
                                        <tr>
                                            <th className="font-semibold p-2">Name</th>
                                            <th className="font-semibold p-2">Level</th>
                                            <th className="font-semibold p-2">Is Goalkeeper</th>
                                            <th className="font-semibold p-2">Confirmed</th>
                                            <th className="font-semibold p-2">Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {team.players.map(player => (
                                            <tr key={player.id} className="border-b border-gray-200">
                                                <td className="p-2">{player.name}</td>
                                                <td className="p-2">{PLAYER_LEVELS_MAP[player.level]}</td>
                                                <td className="p-2">{player.is_goalkeeper ? 'Yes' : 'No'}</td>
                                                <td className="p-2">{player.confirmed ? 'Yes' : 'No'}</td>
                                                <td className="p-2">{format(new Date(player.created_at), 'MMM dd, yyyy')}</td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
