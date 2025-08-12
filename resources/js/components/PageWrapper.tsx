import { Toaster } from '@/components/ui/sonner';
import { SharedData } from '@/types';
import { usePage } from '@inertiajs/react';
import { toast } from 'sonner';

export function PageWrapper({ children }: { children: React.ReactNode }) {
    const { flash, errors } = usePage<SharedData>().props;
    if (flash.success) toast.success(flash.success);
    if (flash.warning) toast.warning(flash.warning);
    if (flash.info) toast.info(flash.info);
    if (errors) {
        Object.values(errors).forEach((error) => {
            toast.error(error);
        });
    }
    return (
        <>
            <div className="min-h-dvh bg-gradient-to-b from-cyan-200 to-white to-[60vh]">{children}</div>
            <Toaster position="top-center" richColors />
        </>
    );
}
