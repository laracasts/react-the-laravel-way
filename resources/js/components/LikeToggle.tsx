import { Link, usePage } from '@inertiajs/react';
import clsx from 'clsx';
import { Heart, LoaderCircle } from 'lucide-react';
import { Puppy, SharedData } from '../types';

export function LikeToggle({ puppy }: { puppy: Puppy }) {
    const { auth } = usePage<SharedData>().props;

    return (
        <Link
            preserveScroll
            method="patch"
            href={route('puppies.like', puppy.id)}
            className={clsx('group', !auth.user && 'cursor-not-allowed')}
            disabled={!auth.user}
        >
            <LoaderCircle className="hidden animate-spin stroke-slate-300 group-data-loading:block" />
            <Heart
                className={clsx(
                    auth.user && puppy.likedBy.includes(auth.user.id) ? 'fill-pink-500 stroke-none' : 'stroke-slate-200 group-hover:stroke-slate-300',
                    'group-data-loading:hidden',
                )}
            />
        </Link>
    );
}
