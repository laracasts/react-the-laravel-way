import { PaginationMeta, PaginationNavLinks } from '@/types';

import { cn } from '@/lib/utils';
import { Link } from '@inertiajs/react';
import { ChevronLeft, ChevronRight } from 'lucide-react';
import { Button } from './ui/button';

type PaginationProps = {
    meta: PaginationMeta;
    links: PaginationNavLinks;
    className?: string;
};

export function Pagination({ meta, links, className }: PaginationProps) {
    return (
        <div className={cn('flex items-center justify-between', className)}>
            <div>
                {links.prev && (
                    <Button asChild variant="ghost">
                        <Link href={links.prev} preserveScroll>
                            <ChevronLeft className="size-4" />
                            <span>Previous</span>
                        </Link>
                    </Button>
                )}
            </div>
            <p className="text-sm font-medium">
                page {meta.current_page} of {meta.last_page}
            </p>
            <div>
                {links.next && (
                    <Button asChild variant="ghost">
                        <Link href={links.next} preserveScroll>
                            <span>Next</span>
                            <ChevronRight className="size-4" />
                        </Link>
                    </Button>
                )}
            </div>
        </div>
    );
}
