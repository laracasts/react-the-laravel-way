import { SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/react';
import { Button } from './ui/button';

export function Header() {
    const { auth } = usePage<SharedData>().props;
    return (
        <header>
            {/* Logo */}
            <div className="flex items-center justify-between">
                <a className="group" href="/">
                    <div className="inline-flex items-center gap-4">
                        <img
                            src="/images/pixel-logo.png"
                            alt="DevPups"
                            className="h-16 transition group-hover:scale-105 group-hover:-rotate-6 md:h-20"
                        />
                        <p className="text-lg font-semibold">Dev Pups</p>
                    </div>
                </a>
                {/* Auth actions */}
                {auth.user ? (
                    <div className="flex items-center gap-4">
                        <p>Hi, {auth.user.name}!</p>
                        <Button asChild>
                            <Link method="post" href={route('logout')}>
                                Log out
                            </Link>
                        </Button>
                    </div>
                ) : (
                    <Button asChild>
                        <Link href={route('login')}>Log in</Link>
                    </Button>
                )}
            </div>
            {/* Hero copy */}
            <div className="mt-6">
                <h1 className="text-lg font-bold">We've got the best puppies!</h1>
                <p className="text-slate-600">Don't take our word — let the pictures do the talking :)</p>
                {!auth.user && (
                    <p className="mt-4 text-slate-600">
                        <Link href={route('login')} className="underline hover:no-underline">
                            Sign in
                        </Link>{' '}
                        to keep track of your favorite puppies and add new ones!
                    </p>
                )}
            </div>
        </header>
    );
}
