"use client";

import { useForm } from "react-hook-form";

type ChatFormValues = {
  message: string;
};

export default function ChatsPage() {
  const { register, handleSubmit, reset, watch } = useForm<ChatFormValues>({
    defaultValues: { message: "" },
  });

  const messageValue = watch("message");

  const onSubmit = () => {
    reset({ message: "" });
  };

  return (
    <div className="min-h-full bg-indigo-300 text-slate-900">
      <div className="mx-auto flex h-full max-w-3xl flex-1 flex-col gap-4 px-5 py-6 sm:px-6">
        <div className="flex items-center justify-between">
          <div className="text-lg font-semibold">Чат</div>
          <div className="text-sm text-slate-600">Онлайн</div>
        </div>

        <main className="flex flex-1 flex-col overflow-hidden rounded-2xl bg-[#FFFFFF] shadow-[0_16px_40px_rgba(15,23,42,0.12)]">
          <section className="flex flex-1 items-center justify-center px-6 py-16 text-center">
            <div>
              <div className="text-base font-semibold">Пока здесь пусто</div>
              <div className="mt-2 text-sm text-slate-500">
                Напишите первое сообщение ниже.
              </div>
            </div>
          </section>

          <div className="border-t border-[#E2E8F0] px-4 py-4 sm:px-6">
            <form
              className="flex flex-col gap-3 rounded-xl bg-[#F8FAFF] p-3 sm:flex-row sm:items-end"
              onSubmit={handleSubmit(onSubmit)}
            >
              <textarea
                className="min-h-[96px] flex-1 resize-none rounded-xl border border-[#D7DBF5] bg-[#FFFFFF] px-3 py-2 text-sm text-slate-900 outline-none transition focus:border-[#A5B4FC] focus:shadow-[0_0_0_3px_rgba(165,180,252,0.35)]"
                placeholder="Написать сообщение..."
                rows={3}
                {...register("message")}
              />
              <button
                className="rounded-xl bg-[#4F46E5] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#4338CA] disabled:cursor-not-allowed disabled:bg-[#C7D2FE]"
                type="submit"
                disabled={!messageValue?.trim()}
              >
                Отправить
              </button>
            </form>
          </div>
        </main>
      </div>
    </div>
  );
}
