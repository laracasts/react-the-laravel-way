import { NewPuppyForm } from '@/components/NewPuppyForm';
import { PuppiesList } from '@/components/PuppiesList';
import { Search } from '@/components/Search';
import { Shortlist } from '@/components/Shortlist';
import PuppiesLayout from '@/layouts/puppies-layout';

import { Filters, PaginatedResponse, Puppy } from '@/types';

export default function App({ puppies: paginatedPuppies, filters }: { puppies: PaginatedResponse<Puppy>; filters: Filters }) {
    return (
        <PuppiesLayout>
            <div className="mt-24 grid gap-8 sm:grid-cols-2">
                <Search filters={filters} />
                <Shortlist puppies={paginatedPuppies.data} />
            </div>
            <PuppiesList puppies={paginatedPuppies} />
            <NewPuppyForm />
        </PuppiesLayout>
    );
}
