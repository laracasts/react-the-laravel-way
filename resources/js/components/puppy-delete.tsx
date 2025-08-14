import { TrashIcon } from 'lucide-react';

import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '@/components/ui/alert-dialog';
import { Button } from '@/components/ui/button';
import { Puppy } from '@/types';
import { useForm } from '@inertiajs/react';

export function PuppyDelete({ puppy }: { puppy: Puppy }) {
    const { processing, delete: destroy } = useForm();
    return (
        <div>
            <AlertDialog>
                <AlertDialogTrigger asChild>
                    <Button size="icon" variant="destructive" aria-label="Delete puppy">
                        <TrashIcon className="size-4" />
                    </Button>
                </AlertDialogTrigger>
                <AlertDialogContent>
                    <AlertDialogHeader>
                        <AlertDialogTitle>Are you absolutely sure?</AlertDialogTitle>
                        <AlertDialogDescription>Who in their right mind would delete such a cute puppy? Seriously?</AlertDialogDescription>
                    </AlertDialogHeader>
                    <AlertDialogFooter>
                        <AlertDialogCancel>Cancel</AlertDialogCancel>
                        <form
                            onSubmit={(e) => {
                                e.preventDefault();
                                destroy(route('puppies.destroy', puppy.id), {
                                    preserveScroll: true,
                                });
                            }}
                        >
                            {' '}
                            <AlertDialogAction type="submit">Delete {puppy.name}</AlertDialogAction>
                        </form>
                    </AlertDialogFooter>
                </AlertDialogContent>
            </AlertDialog>
        </div>
    );
}
