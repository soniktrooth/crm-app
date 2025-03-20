import React from 'react';
import { useQuery, useMutation } from '@tanstack/react-query';
import { Table, Button, TextInput, Group, Stack } from '@mantine/core';
import { contactsApi } from '../../services/contactsApi';

interface Contact {
    id: number;
    name: string;
    phone: string;
    email: string;
}

export const ContactList: React.FC = () => {
    const [searchQuery, setSearchQuery] = React.useState('');

    const { data: contacts, isLoading } = useQuery({
        queryKey: ['contacts', searchQuery],
        queryFn: () => contactsApi.search(searchQuery),
    });

    const callMutation = useMutation({
        mutationFn: (id: number) => contactsApi.call(id),
    });

    if (isLoading) return <div>Loading...</div>;

    return (
        <Stack>
            <Group>
                <TextInput
                    placeholder="Search contacts..."
                    value={searchQuery}
                    onChange={(e) => setSearchQuery(e.target.value)}
                    style={{ width: '300px' }}
                />
            </Group>

            <Table>
                <Table.Thead>
                    <Table.Tr>
                        <Table.Th>Name</Table.Th>
                        <Table.Th>Phone</Table.Th>
                        <Table.Th>Email</Table.Th>
                        <Table.Th>Actions</Table.Th>
                    </Table.Tr>
                </Table.Thead>
                <Table.Tbody>
                    {(contacts || []).map((contact: Contact) => (
                        <Table.Tr key={contact.id}>
                            <Table.Td>{contact.name}</Table.Td>
                            <Table.Td>{contact.phone}</Table.Td>
                            <Table.Td>{contact.email}</Table.Td>
                            <Table.Td>
                                <Button
                                    onClick={() => callMutation.mutate(contact.id)}
                                    size="sm"
                                >
                                    Call
                                </Button>
                            </Table.Td>
                        </Table.Tr>
                    ))}
                </Table.Tbody>
            </Table>
        </Stack>
    );
};