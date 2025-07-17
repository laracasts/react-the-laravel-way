import { Container } from '@/components/Container';
import { Header } from '@/components/Header';
import { NewPuppyForm } from '@/components/NewPuppyForm';
import { PageWrapper } from '@/components/PageWrapper';
import { PuppiesList } from '@/components/PuppiesList';
import { Search } from '@/components/Search';
import { Shortlist } from '@/components/Shortlist';

import { Filters, Puppy, SharedData } from '@/types';
import { usePage } from '@inertiajs/react';
import { useState } from 'react';

export default function App({ puppies, filters }: { puppies: Puppy[]; filters: Filters }) {
    return (
        <PageWrapper>
            <Container>
                <Header />
                <Main inertiaPuppies={puppies} filters={filters} />
            </Container>
        </PageWrapper>
    );
}

function Main({ inertiaPuppies, filters }: { inertiaPuppies: Puppy[]; filters: Filters }) {
    const [puppies, setPuppies] = useState<Puppy[]>(inertiaPuppies);
    const { auth } = usePage<SharedData>().props;

    return (
        <main>
            <div className="mt-24 grid gap-8 sm:grid-cols-2">
                <Search filters={filters} />
                {auth.user && <Shortlist puppies={inertiaPuppies} />}
            </div>
            <PuppiesList puppies={inertiaPuppies} />
            <NewPuppyForm puppies={inertiaPuppies} setPuppies={setPuppies} />
        </main>
    );
}
