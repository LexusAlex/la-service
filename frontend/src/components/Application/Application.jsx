import styles from './Application.module.scss';
import Welcome from "../Welcome/Welcome";

function Application() {
  return (
    <div className={styles.container}>
      <Welcome></Welcome>
    </div>
  );
}

export default Application;
