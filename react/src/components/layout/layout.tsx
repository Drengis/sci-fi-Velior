import type { ReactNode } from "react";
import styles from "./layout.module.css"
import Header from "./header/header"

type LayoutProps = {
    children: ReactNode;
};

export default function Layout({ children }: LayoutProps) {
    return (
        <div className={styles.layout}>
            <Header/>
            {children}
        </div>
    );
}