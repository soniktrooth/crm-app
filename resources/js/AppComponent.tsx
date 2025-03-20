import { BrowserRouter } from 'react-router-dom';
import { Container, Title } from '@mantine/core';
import { ContactList } from './components/Contacts/ContactList';

export function AppComponent() {
    return (
        <BrowserRouter>
            <Container size="lg" py="xl">
                <Title order={1} mb="xl">CRM Contacts</Title>
                <ContactList />
            </Container>
        </BrowserRouter>
    );
}