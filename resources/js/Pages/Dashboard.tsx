import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, useForm } from '@inertiajs/react';
import { PageProps } from '@/types';
import InputLabel from "@/Components/InputLabel";
import { Input } from "postcss";
import TextInput from "@/Components/TextInput";
import InputError from "@/Components/InputError";
import React, { FormEventHandler } from "react";
import PrimaryButton from "@/Components/PrimaryButton";

export default function Dashboard({ auth }: PageProps) {
    const { data, setData, errors, setError, post } = useForm({
        num_players_per_team: 0,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        if (data.num_players_per_team < 1) {
            setError('num_players_per_team', 'Number of players must be at least 1');
        }

        post(route('players.sort'));
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200">
                            <form onSubmit={submit} className="space-y-6">
                                <div>
                                    <InputLabel value="Number of players per team"/>

                                    <TextInput
                                        type="number"
                                        name="number_of_players"
                                        value={data.num_players_per_team}
                                        required
                                        onChange={e => setData('num_players_per_team', Number(e.target.value))}
                                    />

                                    <InputError className="mt-2" message={errors.num_players_per_team}/>
                                </div>
                                <PrimaryButton type="submit" className="mt-4">Sort Team</PrimaryButton>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
