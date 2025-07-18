import { Container } from '@/components/Container';
import { Header } from '@/components/Header';
import { PageWrapper } from '@/components/PageWrapper';

export default function PuppiesLayout({ children }: { children: React.ReactNode }) {
    return (
        <PageWrapper>
            <Container>
                <Header />
                <main>{children}</main>
            </Container>
        </PageWrapper>
    );
}
