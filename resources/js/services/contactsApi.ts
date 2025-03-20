import axios from 'axios';

const api = axios.create({
    baseURL: '/api',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    }
});

interface Contact {
    id: number;
    name: string;
    phone: string;
    email: string;
}

export const contactsApi = {
    search: async (query: string) => {
        const { data } = await api.get<Contact[]>('/contacts/search', {
            params: { q: query }
        });

        return data;
    },

    call: async (id: number) => {
        const { data } = await api.post(`/contacts/${id}/call`);
        return data;
    },

    upsert: async (contact: Omit<Contact, 'id'>) => {
        const { data } = await api.post<Contact>('/contacts', contact);
        return data;
    },

    delete: async (id: number) => {
        const { data } = await api.delete(`/contacts/${id}`);
        return data;
    }
};