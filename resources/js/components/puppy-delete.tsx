import { LoaderCircle, TrashIcon } from 'lucide-react';

import {
    AlertDialog,
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
import clsx from 'clsx';
import { useState } from 'react';

export function PuppyDelete({ puppy }: { puppy: Puppy }) {
    const [open, setOpen] = useState(false);
    const { processing, delete: destroy } = useForm();
    return (
        <div>
            <AlertDialog open={open} onOpenChange={setOpen}>
                <AlertDialogTrigger asChild>
                    <Button className="group/delete bg-background/30 hover:bg-background" size="icon" variant="secondary" aria-label="Delete puppy">
                        <TrashIcon className="size-4 group-hover/delete:stroke-destructive" />
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
                            <Button className="relative disabled:opacity-100" disabled={processing} type="submit">
                                {processing && (
                                    <div className="absolute inset-0 grid place-items-center">
                                        <LoaderCircle className="size-5 animate-spin stroke-primary-foreground" />
                                    </div>
                                )}
                                <span className={clsx(processing && 'invisible')}>Delete {puppy.name}</span>
                            </Button>
                        </form>
                    </AlertDialogFooter>
                </AlertDialogContent>
            </AlertDialog>
        </div>
    );
}
