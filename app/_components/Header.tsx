import Link from "next/link";

export default function Header() {
  return (
    <header className="flex flex-row border-b border-indigo-50 justify-center">
      <Link href="/">
        <div className="border-2 border-indigo-400 p-2 items-center rounded-sm text-[20px] fill:none">
          <span className="text-indigo-400">Schuld</span>
        </div>
      </Link>
    </header>
  );
}
