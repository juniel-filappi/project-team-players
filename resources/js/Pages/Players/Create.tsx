import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, useForm } from '@inertiajs/react';
import { PageProps } from '@/types';
import { PLAYER_LEVEL_VERY_POOR } from "@/variables/PlayerVariables";
import PrimaryButton from "@/Components/PrimaryButton";
import { Transition } from "@headlessui/react";
import React, { FormEventHandler } from "react";
import SecondaryButton from "@/Components/SecondaryButton";
import PlayerForm from "@/Pages/Players/PlayerForm";

export default function Create({ auth }: PageProps) {
    const formData = useForm({
        name: '',
        level: PLAYER_LEVEL_VERY_POOR,
        is_goalkeeper: false,
        confirmed: false,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        formData.post(route('players.store'));
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Create Player</h2>}
        >
            <Head title="Create player" />

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
