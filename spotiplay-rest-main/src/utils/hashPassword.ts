import bcryptjs from 'bcryptjs';

const generateSalt = async (rounds = 10) => {
  return bcryptjs.genSalt(rounds);
};

const hashPassword = async (plain_text: string) => {
  try {
    const salt = await generateSalt();
    const hashedPassword = await bcryptjs.hash(plain_text, salt);
    return hashedPassword;
  } catch (e: any) {
    throw new Error(`Error hashing password: ${e.message}`);
  }
};

export default hashPassword;
