import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";
import InputError from "@/Components/InputError";
import { PLAYER_LEVELS } from "@/variables/PlayerVariables";
import React from "react";

interface PlayerFormProps {
    data: {
        name: string;
        level: number;
        is_goalkeeper: boolean;
        confirmed: boolean;
    };
    errors: {
        name?: string;
        level?: string;
        is_goalkeeper?: string;
        confirmed?: string;
    };
    processing: boolean;
    recentlySuccessful: boolean;
    handleSubmit: (e: React.FormEvent<HTMLFormElement>) => void;
    setData: (key: string, value: string | number | boolean) => void;
    children: React.ReactNode;
}

export default function PlayerForm({ handleSubmit, data, setData, errors, children }: PlayerFormProps) {
    return (
        <form onSubmit={handleSubmit} className="mt-6 space-y-6">
            <div>
                <InputLabel htmlFor="name" value="Name"/>

                <TextInput
                    id="name"
                    className="mt-1 block w-full"
                    value={data.name}
                    onChange={(e) => setData('name', e.target.value)}
                    required
                    isFocused
                    autoComplete="name"
                />

                <InputError className="mt-2" message={errors.name}/>
            </div>

            <div>
                <InputLabel htmlFor="level" value="Level"/>

                <div className="flex gap-4">
                    {PLAYER_LEVELS.map((level) => (
                        <div key={level.value}>
                            <input
                                id={`level-${level.value}`}
                                type="radio"
                                value={level.value}
                                checked={data.level === level.value}
                                onChange={() => setData('level', level.value)}
                            />

                            <label htmlFor={`level-${level.value}`}
                                   className="ml-2">{level.label}</label>
                        </div>
                    ))}
                </div>

                <InputError className="mt-2" message={errors.level}/>
            </div>

            <div>
                <InputLabel htmlFor="level" value="Is Goalkeeper?"/>

                <div className="flex gap-4">
                    <div>
                        <input
                            id="is_goalkeeper-yes"
                            type="radio"
                            checked={data.is_goalkeeper}
                            onChange={() => setData('is_goalkeeper', true)}
                        />

                        <label
                            htmlFor="is_goalkeeper-yes"
                            className="ml-2"
                        >
                            Yes
                        </label>
                    </div>
                    <div>
                        <input
                            id="is_goalkeeper-no"
                            type="radio"
                            checked={!data.is_goalkeeper}
                            onChange={() => setData('is_goalkeeper', false)}
                        />

                        <label
                            htmlFor="is_goalkeeper-no"
                            className="ml-2"
                        >
                            No
                        </label>
                    </div>
                </div>

                <InputError className="mt-2" message={errors.is_goalkeeper}/>
            </div>

            <div>
                <InputLabel htmlFor="level" value="Is Confirmed?"/>

                <div className="flex gap-4">
                    <div>
                        <input
                            id="is_confirmed-yes"
                            type="radio"
                            checked={data.confirmed}
                            onChange={() => setData('confirmed', true)}
                        />

                        <label
                            htmlFor="is_confirmed-yes"
                            className="ml-2"
                        >
                            Yes
                        </label>
                    </div>
                    <div>
                        <input
                            id="is_confirmed-no"
                            type="radio"
                            checked={!data.confirmed}
                            onChange={() => setData('confirmed', false)}
                        />

                        <label
                            htmlFor="is_confirmed-no"
                            className="ml-2"
                        >
                            No
                        </label>
                    </div>
                </div>

                <InputError className="mt-2" message={errors.confirmed}/>
            </div>

            <div>
                {children}
            </div>
        </form>
    )
}
