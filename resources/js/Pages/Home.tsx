export default function Home({ message }: { message: string }) {
  return (
    <main style={{ fontFamily: 'sans-serif', padding: '2rem', lineHeight: 1.6 }}>
      <h1>React + Inertia + TypeScript</h1>
      <p>{message}</p>
    </main>
  );
}
