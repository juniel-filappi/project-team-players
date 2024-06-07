import { Pencil, Trash } from "@phosphor-icons/react";

interface TableProps {
    headers: {
        field: string;
        headerName: string;
        valueGetter?: (row: any) => string;
    }[];
    rows: any[];
    onEdit: (id: number) => void;
    onDelete: (id: number) => void;
}

export default function Table({
  headers,
  rows,
  onEdit,
  onDelete,
}: TableProps) {
    return (
        <table className="w-full text-sm text-center rtl:text-right text-gray-500">
            <thead className="text-xs text-gray-700 uppercase bg-gray-300">
            <tr>
                {headers.map((header, index) => (
                    <th key={index} className="font-semibold p-2">{header.headerName}</th>
                ))}
                <th className="font-semibold p-2"></th>
            </tr>
            </thead>
            <tbody>
            {rows.map((row, index) => (
                <tr key={index} className="border-b border-gray-200">
                    {headers.map((header, index) => (
                        <td key={index} className="p-2">{header.valueGetter ? header.valueGetter(row) : row[header.field]}</td>
                    ))}
                    <td className="px-6 py-4 flex gap-3">
                        <button className="text-indigo-600 hover:text-indigo-900" onClick={() => onEdit(row.id)}>
                            <Pencil size={16}/>
                        </button>
                        <button className="text-red-600 hover:text-red-900" onClick={() => onDelete(row.id)}>
                            <Trash size={16}/>
                        </button>
                    </td>
                </tr>
            ))}

            {rows.length === 0 && (
                <tr>
                    <td colSpan={headers.length + 1} className="p-4 text-center">
                        No records found
                    </td>
                </tr>
            )}
            </tbody>
        </table>
    );
}
