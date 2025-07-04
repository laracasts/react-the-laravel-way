import { Container } from '@/components/Container';
import { Header } from '@/components/Header';
import { NewPuppyForm } from '@/components/NewPuppyForm';
import { PageWrapper } from '@/components/PageWrapper';
import { PuppiesList } from '@/components/PuppiesList';
import { Search } from '@/components/Search';
import { Shortlist } from '@/components/Shortlist';

import { getPuppies } from '@/queries';
import { Puppy } from '@/types';
import { LoaderCircle } from 'lucide-react';
import { Suspense, use, useState } from 'react';
import { ErrorBoundary } from 'react-error-boundary';

export default function App({ puppies }: { puppies: Puppy[] }) {
    return (
        <PageWrapper>
            <Container>
                <Header />
                <ul className="mt-4 flex flex-wrap gap-4">
                    {puppies.map((puppy) => (
                        <li className="flex gap-2 bg-white p-6 ring ring-black/10">
                            <img src={puppy.image_url} alt={puppy.name} className="size-24 object-cover" />
                            <h2>{puppy.name}</h2>
                        </li>
                    ))}
                </ul>

                <ErrorBoundary
                    fallbackRender={({ error }) => (
                        <div className="mt-12 bg-red-100 p-6 shadow ring ring-black/5">
                            <p className="text-red-500">
                                {error.message}: {error.details}
                            </p>
                        </div>
                    )}
                >
                    <Suspense
                        fallback={
                            <div className="mt-12 grid h-48 place-items-center">
                                <LoaderCircle className="animate-spin stroke-slate-300" />
                            </div>
                        }
                    >
                        <Main />
                    </Suspense>
                </ErrorBoundary>
            </Container>
        </PageWrapper>
    );
}

const puppyPromise = getPuppies();

function Main() {
    const apiPuppies = use(puppyPromise);
    const [searchQuery, setSearchQuery] = useState('');
    const [puppies, setPuppies] = useState<Puppy[]>(apiPuppies);

    return (
        <main>
            <div className="mt-24 grid gap-8 sm:grid-cols-2">
                <Search searchQuery={searchQuery} setSearchQuery={setSearchQuery} />
                <Shortlist puppies={puppies} setPuppies={setPuppies} />
            </div>
            <PuppiesList puppies={puppies} setPuppies={setPuppies} searchQuery={searchQuery} />
            <NewPuppyForm puppies={puppies} setPuppies={setPuppies} />
        </main>
    );
}
