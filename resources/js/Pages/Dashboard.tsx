import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { PageProps } from '@/types';
import Table from "@/Components/Table";

export default function Dashboard({ auth }: PageProps) {
    const headers = ['Name', 'Title', 'Status', 'Role', 'Created At'];
    const rows = [
        ['John Doe', 'Software Engineer', 'Active', 'Admin', '2021-08-01'],
        ['Jane Doe', 'Software Engineer', 'Active', 'Admin', '2021-08-01'],
        ['John Smith', 'Software Engineer', 'Active', 'Admin', '2021-08-01'],
        ['Jane Smith', 'Software Engineer', 'Active', 'Admin', '2021-08-01'],
        ['John Doe', 'Software Engineer', 'Active', 'Admin', '2021-08-01'],
        ['Jane Doe', 'Software Engineer', 'Active', 'Admin', '2021-08-01'],
        ['John Smith', 'Software Engineer', 'Active', 'Admin', '2021-08-01'],
        ['Jane Smith', 'Software Engineer', 'Active', 'Admin', '2021-08-01'],
    ];

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="relative overflow-x-auto">
                            <Table headers={headers} rows={rows} />
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
