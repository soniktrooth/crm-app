import React from 'react';
import ReactDOM from 'react-dom/client';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { MantineProvider } from '@mantine/core';
import { AppComponent } from './AppComponent';
import '@mantine/core/styles.css';

const queryClient = new QueryClient();

const container = document.getElementById('app');
if (container) {
    const root = ReactDOM.createRoot(container);
    root.render(
        <React.StrictMode>
            <QueryClientProvider client={queryClient}>
                <MantineProvider>
                    <AppComponent />
                </MantineProvider>
            </QueryClientProvider>
        </React.StrictMode>
    );
}