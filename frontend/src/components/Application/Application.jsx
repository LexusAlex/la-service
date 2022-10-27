import styles from './Application.module.scss';
import Home from "../Home/Home";

function Application() {
  return (
    <div className={styles.container}>
      <Home></Home>
    </div>
  );
}

export default Application;
