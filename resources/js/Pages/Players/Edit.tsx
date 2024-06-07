import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, useForm } from '@inertiajs/react';
import { PageProps } from '@/types';
import { PLAYER_LEVEL_VERY_POOR } from "@/variables/PlayerVariables";
import PrimaryButton from "@/Components/PrimaryButton";
import { Transition } from "@headlessui/react";
import React, { FormEventHandler } from "react";
import SecondaryButton from "@/Components/SecondaryButton";
import PlayerForm from "@/Pages/Players/PlayerForm";
import { IPlayer } from "@/interfaces/IPlayer";

export default function Edit({ auth, player }: PageProps<{ player: IPlayer }>) {
    const formData = useForm({
        name: player.name,
        level: player.level,
        is_goalkeeper: player.is_goalkeeper,
        confirmed: player.confirmed,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        formData.put(route('players.update', player.id));
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Update Player</h2>}
        >
            <Head title="Update player" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <PlayerForm handleSubmit={submit} {...formData} >
                            <div className="flex items-center gap-4">
                                <Link href={route('players.index')}>
                                    <SecondaryButton>Cancel</SecondaryButton>
                                </Link>
                                <PrimaryButton disabled={formData.processing}>Save</PrimaryButton>

                                <Transition
                                    show={formData.recentlySuccessful}
                                    enter="transition ease-in-out"
                                    enterFrom="opacity-0"
                                    leave="transition ease-in-out"
                                    leaveTo="opacity-0"
                                >
                                    <p className="text-sm text-gray-600">Saved.</p>
                                </Transition>
                            </div>
                        </PlayerForm>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
