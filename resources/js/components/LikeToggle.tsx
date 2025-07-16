import { useForm, usePage } from '@inertiajs/react';
import clsx from 'clsx';
import { Heart, LoaderCircle } from 'lucide-react';
import { Puppy, SharedData } from '../types';

export function LikeToggle({ puppy }: { puppy: Puppy }) {
    const { auth } = usePage<SharedData>().props;
    const { processing, patch } = useForm();

    return (
        <form
            onSubmit={(e) => {
                e.preventDefault();
                patch(route('puppies.like', puppy.id), {
                    preserveScroll: true,
                });
            }}
        >
            <button type="submit" className={clsx('group', !auth.user && 'cursor-not-allowed')} disabled={!auth.user || processing}>
                {processing ? (
                    <LoaderCircle className="animate-spin stroke-slate-300" />
                ) : (
                    <Heart
                        className={clsx(
                            auth.user && puppy.likedBy.includes(auth.user.id)
                                ? 'fill-pink-500 stroke-none'
                                : 'stroke-slate-200 group-hover:stroke-slate-300',
                        )}
                    />
                )}
            </button>
        </form>
    );
}
