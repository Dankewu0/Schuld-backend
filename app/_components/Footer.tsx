import Image from "next/image";
import Link from "next/link";

export default function Footer() {
  return (
    <footer className="flex flex-row border-t bg-[#757FE6] items-center text-[20px] justify-center border-indigo-50 h-16 px-4">
      <div className="flex flex-row gap-6">
        <Link
          href="https://github.com/"
          target="_blank"
          rel="noopener noreferrer"
          className="transform transition duration-300 hover:scale-110 hover:drop-shadow-lg"
        >
          <Image src="/github.svg" alt="GitHub" width={28} height={28} />
        </Link>

        <Link
          href="https://vercel.com/"
          target="_blank"
          rel="noopener noreferrer"
          className="transform transition duration-300 hover:scale-110 hover:drop-shadow-lg"
        >
          <Image src="/vercel.svg" alt="Vercel" width={28} height={28} />
        </Link>

        <Link
          href="https://telegram.org/"
          target="_blank"
          rel="noopener noreferrer"
          className="transform transition duration-300 hover:scale-110 hover:drop-shadow-lg"
        >
          <Image src="/telegram.svg" alt="Telegram" width={28} height={28} />
        </Link>
      </div>
    </footer>
  );
}
