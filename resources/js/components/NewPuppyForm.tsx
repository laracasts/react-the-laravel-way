import { useForm } from '@inertiajs/react';
import { useRef } from 'react';

export function NewPuppyForm() {
    const fileInputRef = useRef<HTMLInputElement>(null);

    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        trait: '',
        image_url: null as File | null,
    });

    return (
        <div className="mt-12 flex items-center justify-between bg-white p-8 shadow ring ring-black/5">
            <form
                onSubmit={(e) => {
                    e.preventDefault();
                    post(route('puppies.store'), {
                        preserveScroll: true,
                        onSuccess: () => {
                            reset();
                            if (fileInputRef.current) {
                                fileInputRef.current.value = '';
                            }
                            if (typeof window !== 'undefined') {
                                window.scrollTo({ top: 0, behavior: 'smooth' });
                            }
                        },
                    });
                }}
                className="mt-4 flex w-full flex-col items-start gap-4"
            >
                <div className="grid w-full gap-6 md:grid-cols-3">
                    <fieldset className="flex w-full flex-col gap-1">
                        <label htmlFor="name">Name</label>
                        <input
                            className="max-w-96 rounded-sm bg-white px-2 py-1 ring ring-black/20 focus:ring-2 focus:ring-cyan-500 focus:outline-none"
                            id="name"
                            type="text"
                            name="name"
                            value={data.name}
                            onChange={(e) => setData('name', e.target.value)}
                        />
                        {errors.name && <p className="mt-1 text-sm text-red-500">{errors.name}</p>}
                    </fieldset>
                    <fieldset className="flex w-full flex-col gap-1">
                        <label htmlFor="trait">Personality trait</label>
                        <input
                            // required
                            className="max-w-96 rounded-sm bg-white px-2 py-1 ring ring-black/20 focus:ring-2 focus:ring-cyan-500 focus:outline-none"
                            id="trait"
                            type="text"
                            name="trait"
                            value={data.trait}
                            onChange={(e) => setData('trait', e.target.value)}
                        />
                        {errors.trait && <p className="mt-1 text-sm text-red-500">{errors.trait}</p>}
                    </fieldset>
                    <fieldset className="col-span-2 flex w-full flex-col gap-1">
                        <label htmlFor="image_url">Profile pic</label>
                        <input
                            ref={fileInputRef}
                            className="max-w-96 rounded-sm bg-white px-2 py-1 ring ring-black/20 focus:ring-2 focus:ring-cyan-500 focus:outline-none"
                            id="image_url"
                            type="file"
                            name="image_url"
                            onChange={(e) => setData('image_url', e.target.files ? e.target.files[0] : null)}
                        />
                        {errors.image_url && <p className="mt-1 text-sm text-red-500">{errors.image_url}</p>}
                    </fieldset>
                </div>
                <button
                    className="mt-4 inline-block rounded bg-cyan-300 px-4 py-2 font-medium text-cyan-900 hover:bg-cyan-200 focus:ring-2 focus:ring-cyan-500 focus:outline-none disabled:cursor-not-allowed disabled:bg-slate-200"
                    type="submit"
                    disabled={processing}
                >
                    {processing ? `Adding ${data.name || 'puppy'}...` : 'Add puppy'}
                </button>
            </form>
        </div>
    );
}
