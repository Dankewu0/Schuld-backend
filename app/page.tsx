import SubmitForm from "./_components/SubmitForm";

export default function Home() {
  return (
    <div className="flex min-h-screen items-center justify-center font-sans dark:bg-black">
      <SubmitForm
        titleSpan="Авторизация"
        linkSpan="Нет аккаунта?"
        linkHref="/registration"
        buttonTitle="Войти"
      />
    </div>
  );
}
