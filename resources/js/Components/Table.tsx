
interface TableProps {
    headers: string[];
    rows: string[][];
}

export default function Table({
    headers,
    rows,
}: TableProps) {
    return (
        <table className="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead
                className="text-xs text-gray-700 uppercase bg-gray-300">
            <tr>
                {headers.map((header, index) => (
                    <th key={index} className="font-semibold p-2">{header}</th>
                ))}
            </tr>
            </thead>
            <tbody>
            {rows.map((row, index) => (
                <tr key={index} className="bg-white border-b">
                    {row.map((cell, index) => (
                        <td key={index} className="px-6 py-4">{cell}</td>
                    ))}
                </tr>
            ))}
            </tbody>
        </table>
    );
}
